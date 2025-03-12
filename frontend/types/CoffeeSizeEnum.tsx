export enum CoffeeSizeEnum {
    SMALL = "SMALL",
    MEDIUM = "MEDIUM",
    LARGE = "LARGE",
}

export const coffeeSizeLabelsFromEnum: Record<CoffeeSizeEnum, string> = {
    [CoffeeSizeEnum.SMALL]: "Court",
    [CoffeeSizeEnum.MEDIUM]: "Normal",
    [CoffeeSizeEnum.LARGE]: "Long",
};

export const coffeeSizeEnumFromString: Record<string, CoffeeSizeEnum> = {
    "SMALL": CoffeeSizeEnum.SMALL,
    "MEDIUM": CoffeeSizeEnum.MEDIUM,
    "LARGE": CoffeeSizeEnum.LARGE,
};