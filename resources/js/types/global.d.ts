import { PageProps as InertiaPageProps } from "@inertiajs/core";
import { AxiosInstance } from "axios";
import { route as ziggyRoute } from "ziggy-js";
import { Config } from "../../../vendor/tightenco/ziggy";

export interface User {
    id: number;
    name: string;
    email: string;
    email_verified_at?: string;
}

export type AppPageProps<
    T extends Record<string, unknown> = Record<string, unknown>,
> = T & {
    auth: {
        user: User;
    };
    ziggy: Config & { location: string };
};

declare global {
    interface Window {
        axios: AxiosInstance;
    }

    var route: typeof ziggyRoute;
}

declare module "vue" {
    interface ComponentCustomProperties {
        route: typeof ziggyRoute;
    }
}

declare module "@inertiajs/core" {
    export interface PageProps extends InertiaPageProps, AppPageProps {}
}
