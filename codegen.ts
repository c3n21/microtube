import type { CodegenConfig } from "@graphql-codegen/cli";

const config: CodegenConfig = {
    overwrite: true,
    schema: ["./graphql/*.graphql"],
    documents: "./graphql/documents/*.graphql",
    generates: {
        "./resources/js/types/": {
            preset: "client",
            plugins: [],
        },
        "./graphql.schema.json": {
            plugins: ["introspection"],
        },
    },
};

export default config;
