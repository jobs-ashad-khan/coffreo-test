import { useEffect } from "react";
import {CoffeeMessageDTO} from "@/types/CoffeeMessageDTO";

const useMercure = (topic: string, onUpdate: (data: CoffeeMessageDTO) => void) => {
    useEffect(() => {
        const mercureUrl = process.env.NEXT_PUBLIC_MERCURE_URL;

        const eventSourceUrl = `${mercureUrl}?topic=${topic}`;
        const eventSource = new EventSource(eventSourceUrl);

        eventSource.onopen = () => {
            console.log("Connexion Mercure ouverte");
        };

        eventSource.onmessage = (event) => {
            const data = JSON.parse(event.data);
            console.log("Message receive from Mercure")
            console.log(data);
            onUpdate(data);
        };

        eventSource.onerror = (error) => {
            console.error("Erreur Mercure:", error);
            eventSource.close();
        };

        return () => {
            eventSource.close();
        };
    }, [topic, onUpdate]);
};

export default useMercure;
