"use client";

import {useEffect, useState} from "react";
import {CoffeeOrderDTO} from "@/types/CoffeeOrderDTO";
import CoffeeForm from "@/app/components/CoffeeForm";
import {getCoffeeOrders} from "@/utils/coffeeOrderService";
import CoffeeOrderList from "@/app/components/CoffeeOrderList";
<<<<<<< Updated upstream
import webSocketService from "@/utils/webSocketService";
import {CoffeeMessageDTO} from "@/types/CoffeeMessageDTO";
=======
import useMercure from "@/app/hooks/useMercure";
>>>>>>> Stashed changes

export default function Home() {
  const [coffeeOrders, setCoffeeOrders] = useState<CoffeeOrderDTO[]>([]);

  // Charger les commandes au montage du composant
  useEffect(() => {
    const loadCoffeeOrders = async () => {
      try {
        const fetchedOrders = await getCoffeeOrders();
        setCoffeeOrders(fetchedOrders);
      } catch (error) {
        console.error("Erreur lors du chargement des commandes :", error);
      }
    };

    loadCoffeeOrders();

    // Connexion WebSocket et écoute des mises à jour
    webSocketService.connect();

    const handleCoffeeOrderUpdate = (messageDTO: CoffeeMessageDTO) => {
      setCoffeeOrders((prevOrders) =>
          prevOrders.map((coffeeOrder) =>
              coffeeOrder.id === messageDTO.id ? {...coffeeOrder, status: messageDTO.status} : coffeeOrder
          )
      );
    };

    webSocketService.addListener(handleCoffeeOrderUpdate);

    return () => {
      webSocketService.removeListener(handleCoffeeOrderUpdate);
    };

  }, []);

  const handleNewCoffeeOrder = async (newCoffeeOrder: CoffeeOrderDTO) => {
    setCoffeeOrders((prevOrders) => [
      { ...newCoffeeOrder },
      ...prevOrders,
    ]);
  };

  useMercure("coffee-orders/update", (updatedCoffeeOrder) => {
    setCoffeeOrders((prevOrders) => {
      return prevOrders.map((coffeeOrder) =>
          (Number(coffeeOrder.id) === Number(updatedCoffeeOrder.id) ? {...coffeeOrder, status: updatedCoffeeOrder.status} : coffeeOrder)
      );
    });
  });

  return (
      <div className="max-w-3xl mx-auto mt-10 p-6 bg-white shadow-lg rounded-lg">
        <CoffeeForm onCoffeeOrder={handleNewCoffeeOrder} />
        <CoffeeOrderList coffeeOrders={coffeeOrders} />
      </div>
  );
}
