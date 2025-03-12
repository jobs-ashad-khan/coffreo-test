import {CoffeeDTO} from "@/types/CoffeeDTO";

export interface CoffeeOrderDTO {
    id: number;
    coffee: CoffeeDTO;
    status: string;
    createdAt: Date;
}