import { useState, useEffect } from "../../../../imports";

const cache = {};
const CACHE_EXPIRY_MS = 10 * 60 * 1000;

const usePostPublication = (key) => {
    const [data, setData] = useState(null);
    const [error, setError] = useState(null);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        const fetchData = async() => {
            setLoading(true);
            const cacheKey = `${'http://localhost/chinchinaes/api/controllers/endpoints/get/publication_revista.php'}_${JSON.stringify(key)}`;
            const now = Date.now();

            if (cache[cacheKey] && now - cache[cacheKey].timestamp < CACHE_EXPIRY_MS) {
                setData(cache[cacheKey].data);
                setLoading(false);
                return;
            }

            try {
                const response = await fetch('http://localhost/chinchinaes/api/controllers/endpoints/get/publication_revista.php', {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify(key),
                });

                if (!response.ok) {
                    const errData = await response.json();
                    console.log('Server Error:', errData);
                    throw new Error(errData.error || 'Request failed');
                }

                const result = await response.json();
                cache[cacheKey] = { data: result, timestamp: now };
                setData(result);
            } catch (err) {
                console.error('Fetch Error:', err);
                setError(err.message);
            } finally {
                setLoading(false);
            }
        };

        fetchData();
    }, [key]);

    return { data, loading, error };
};

export default usePostPublication;