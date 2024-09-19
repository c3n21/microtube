import type { CodegenConfig } from "@graphql-codegen/cli";

const config: CodegenConfig = {
    overwrite: true,
    schema: ["./graphql/*.graphql"],
    documents: "./graphql/documents/*.graphql",
    generates: {
        "./resources/js/types/graphql.ts": {
            config: {
                /**
                 * @see {@link https://www.npmjs.com/package/@vue/composition-api}
                 */
                vueCompositionApiImportFrom: "vue",
            },
            plugins: [
                "typescript",
                "typescript-operations",
                "typescript-vue-apollo",
            ],
        },
        "./graphql.schema.json": {
            plugins: ["introspection"],
        },
    },
};

export default config;
