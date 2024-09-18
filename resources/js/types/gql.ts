/* eslint-disable */
import * as types from './graphql';
import { TypedDocumentNode as DocumentNode } from '@graphql-typed-document-node/core';

/**
 * Map of all GraphQL operations in the project.
 *
 * This map has several performance disadvantages:
 * 1. It is not tree-shakeable, so it will include all operations in the project.
 * 2. It is not minifiable, so the string of a GraphQL query will be multiple times inside the bundle.
 * 3. It does not support dead code elimination, so it will add unused operations.
 *
 * Therefore it is highly recommended to use the babel or swc plugin for production.
 */
const documents = {
    "mutation UploadVideo($file: Upload!, $title: String!, $user_id: ID!) {\n  createVideo(file: $file, title: $title, user_id: $user_id) {\n    id\n    title\n    uploaded_at\n  }\n}": types.UploadVideoDocument,
    "query getVideos($title: String) {\n  videos(title: $title) {\n    title\n    uploaded_at\n    user {\n      name\n      email\n    }\n  }\n}": types.GetVideosDocument,
};

/**
 * The graphql function is used to parse GraphQL queries into a document that can be used by GraphQL clients.
 *
 *
 * @example
 * ```ts
 * const query = graphql(`query GetUser($id: ID!) { user(id: $id) { name } }`);
 * ```
 *
 * The query argument is unknown!
 * Please regenerate the types.
 */
export function graphql(source: string): unknown;

/**
 * The graphql function is used to parse GraphQL queries into a document that can be used by GraphQL clients.
 */
export function graphql(source: "mutation UploadVideo($file: Upload!, $title: String!, $user_id: ID!) {\n  createVideo(file: $file, title: $title, user_id: $user_id) {\n    id\n    title\n    uploaded_at\n  }\n}"): (typeof documents)["mutation UploadVideo($file: Upload!, $title: String!, $user_id: ID!) {\n  createVideo(file: $file, title: $title, user_id: $user_id) {\n    id\n    title\n    uploaded_at\n  }\n}"];
/**
 * The graphql function is used to parse GraphQL queries into a document that can be used by GraphQL clients.
 */
export function graphql(source: "query getVideos($title: String) {\n  videos(title: $title) {\n    title\n    uploaded_at\n    user {\n      name\n      email\n    }\n  }\n}"): (typeof documents)["query getVideos($title: String) {\n  videos(title: $title) {\n    title\n    uploaded_at\n    user {\n      name\n      email\n    }\n  }\n}"];

export function graphql(source: string) {
  return (documents as any)[source] ?? {};
}

export type DocumentType<TDocumentNode extends DocumentNode<any, any>> = TDocumentNode extends DocumentNode<  infer TType,  any>  ? TType  : never;