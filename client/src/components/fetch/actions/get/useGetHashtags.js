import { useState, useEffect } from "../../../../imports";

const cache = {};
const CACHE_EXPIRY_MS = 10 * 60 * 1000;

const useGetHashtags = ({ keys }) => {
    const [data, setData] = useState({});
    const [error, setError] = useState(null);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        const fetchData = async() => {
            setLoading(true);
            const fetchPromises = keys.map(async(key) => {
                const cacheKey = `${'http://localhost/chinchinaes/api/controllers/endpoints/get/hashtags.php'}_${JSON.stringify(key)}`;
                const now = Date.now();

                if (cache[cacheKey] && now - cache[cacheKey].timestamp < CACHE_EXPIRY_MS) {
                    return { key: key.key, response: cache[cacheKey].data };
                }

                try {
                    const response = await fetch('http://localhost/chinchinaes/api/controllers/endpoints/get/hashtags.php', {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                        },
                        body: JSON.stringify(key),
                    });
                    const data = await response.json();
                    cache[cacheKey] = { data, timestamp: now };
                    return { key: key.key, response: data };
                } catch (err) {
                    return { key: key.key, error: err.message };
                }
            });

            try {
                const results = await Promise.all(fetchPromises);
                const dataMap = results.reduce((acc, { key, response, error }) => {
                    if (error) {
                        setError((prevError) => `${prevError ? prevError + ', ' : ''}${error}`);
                    } else {
                        acc[key] = response;
                    }
                    return acc;
                }, {});
                setData(dataMap);
            } catch (err) {
                setError(err.message);
            } finally {
                setLoading(false);
            }
        };

        fetchData();
    }, [keys]);

    return { data, loading, error };
};

export default useGetHashtags;