import { ApolloClient, InMemoryCache } from "@apollo/client/core";
import createUploadLink from "apollo-upload-client/createUploadLink.mjs";

const link = createUploadLink({
    uri: "http://127.0.0.1/graphql", // this can be improved with env var eventually
});

// Create the Apollo client
const apolloClient = new ApolloClient({
    link,
    cache: new InMemoryCache(),
});

export { apolloClient };
