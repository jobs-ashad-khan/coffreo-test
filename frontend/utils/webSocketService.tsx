import {CoffeeMessageDTO} from "@/types/CoffeeMessageDTO";

const WEBSOCKET_URL = process.env.NEXT_PUBLIC_WEBSOCKET_URL;

type CoffeeOrderUpdateCallback = (updatedOrder: CoffeeMessageDTO) => void;

class WebSocketService {
    private socket: WebSocket | null = null;
    private callbacks: CoffeeOrderUpdateCallback[] = [];

    /**
     * Initialise la connexion WebSocket et écoute les messages entrants.
     */
    connect() {
        if (this.socket) return;

        this.socket = new WebSocket(WEBSOCKET_URL ?? "");

        this.socket.onopen = () => console.log("WebSocket connecté ✅");
        this.socket.onerror = (error) => console.error("WebSocket erreur ❌", error);

        this.socket.onmessage = (event) => {
            try {
                const updatedCoffeeOrder: CoffeeMessageDTO = JSON.parse(event.data);
                this.notifyListeners(updatedCoffeeOrder);
            } catch (error) {
                console.error("Erreur lors du parsing du message WebSocket", error);
            }
        };

        this.socket.onclose = () => {
            console.log("WebSocket déconnecté 🔌");
            this.socket = null;
        };
    }

    /**
     * Ajoute un listener pour recevoir les mises à jour des commandes.
     */
    addListener(callback: CoffeeOrderUpdateCallback) {
        this.callbacks.push(callback);
    }

    /**
     * Supprime un listener lorsqu'un composant est démonté.
     */
    removeListener(callback: CoffeeOrderUpdateCallback) {
        this.callbacks = this.callbacks.filter((cb) => cb !== callback);
    }

    /**
     * Notifie tous les listeners lorsqu'une commande est mise à jour.
     */
    private notifyListeners(updatedCoffeeOrder: CoffeeMessageDTO) {
        this.callbacks.forEach((callback) => callback(updatedCoffeeOrder));
    }
}

// Singleton pour éviter plusieurs connexions WebSocket
const websocketService = new WebSocketService();
export default websocketService;
