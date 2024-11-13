// usePostIFormInscriptions.js

import { useState, useEffect, Swal } from "../../../../imports";

const cache = {};
const CACHE_EXPIRY_MS = 10 * 60 * 1000;

const usePostIFormInscriptions = (key, reset) => {
    const [data, setData] = useState(null);
    const [error, setError] = useState(null);
    const [loading, setLoading] = useState(true);
    const [Body, setBody] = useState({});

    useEffect(() => {
        const obj = {};
        for (const value in key) {
            obj[value] = key[value];
        }
        setBody({...obj });
    }, []);

    useEffect(() => {
        console.log(Body);
    }, [Body]);

    const OnChange = (e) => {
        const { name, value, type, files } = e.target;

        if (type === "file") {
            setBody((prevBody) => ({
                ...prevBody,
                [name]: files[0],
            }));
        } else {
            setBody((prevBody) => ({
                ...prevBody,
                [name]: value,
            }));
        }
    };

    const OnSubmit = async(e) => {
        e.preventDefault();

        setLoading(true);
        const cacheKey = `${"http://localhost/chinchinaes/api/controllers/endpoints/post/inscriptions.php"}_${JSON.stringify(
      Body
    )}`;
        const now = Date.now();

        if (cache[cacheKey] && now - cache[cacheKey].timestamp < CACHE_EXPIRY_MS) {
            setData(cache[cacheKey].data);
            setLoading(false);
            return;
        }

        try {
            const formData = new FormData();

            for (const i in Body) {
                if (Body[i] instanceof File) {
                    formData.append(i, Body[i]);
                } else {
                    formData.append(i, Body[i]);
                }
            }

            const response = await fetch(
                "http://localhost/chinchinaes/api/controllers/endpoints/post/inscriptions.php", {
                    method: "POST",
                    body: formData,
                }
            );

            if (!response.ok) {
                const errData = await response.json();
                console.log("Server Error:", errData);
                throw new Error(errData.error || "Request failed");
            }

            const result = await response.json();
            if (result.success === true) {
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: "¡Solicitud hecha!",
                    showConfirmButton: false,
                    timer: 1500
                });
            } else if (result.error === "IncorrectValue") {
                Swal.fire({
                    position: "top-end",
                    icon: "Error",
                    title: "¡Las imágenes o el archivo son incorrectos. ¡Ingresa imágenes o un archivo válido!",
                    showConfirmButton: false,
                    timer: 1500
                });
            } else if (result.error === "DontExistData") {
                Swal.fire({
                    position: "top-end",
                    icon: "Error",
                    title: "¡Falta información!",
                    showConfirmButton: false,
                    timer: 1500
                });
            }
            cache[cacheKey] = { data: result, timestamp: now };
            setData(result);
        } catch (err) {
            console.error("Fetch Error:", err);
            setError(err.message);
        } finally {
            setLoading(false);
        }

        if (reset.current) {
            reset.current.reset();
        }
    };

    return { OnChange, OnSubmit, data, loading, error };
};

export default usePostIFormInscriptions;