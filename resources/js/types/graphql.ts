/* eslint-disable */
import { TypedDocumentNode as DocumentNode } from '@graphql-typed-document-node/core';
export type Maybe<T> = T | null;
export type InputMaybe<T> = Maybe<T>;
export type Exact<T extends { [key: string]: unknown }> = { [K in keyof T]: T[K] };
export type MakeOptional<T, K extends keyof T> = Omit<T, K> & { [SubKey in K]?: Maybe<T[SubKey]> };
export type MakeMaybe<T, K extends keyof T> = Omit<T, K> & { [SubKey in K]: Maybe<T[SubKey]> };
export type MakeEmpty<T extends { [key: string]: unknown }, K extends keyof T> = { [_ in K]?: never };
export type Incremental<T> = T | { [P in keyof T]?: P extends ' $fragmentName' | '__typename' ? T[P] : never };
/** All built-in and custom scalars, mapped to their actual values */
export type Scalars = {
  ID: { input: string; output: string; }
  String: { input: string; output: string; }
  Boolean: { input: boolean; output: boolean; }
  Int: { input: number; output: number; }
  Float: { input: number; output: number; }
  /** Any constant literal value: https://graphql.github.io/graphql-spec/draft/#sec-Input-Values */
  BuilderValue: { input: any; output: any; }
  /** Any constant literal value: https://graphql.github.io/graphql-spec/draft/#sec-Input-Values */
  CanArgs: { input: any; output: any; }
  /** A datetime string with format `Y-m-d H:i:s`, e.g. `2018-05-23 13:43:32`. */
  DateTime: { input: any; output: any; }
  /** Any constant literal value: https://graphql.github.io/graphql-spec/draft/#sec-Input-Values */
  EnumValue: { input: any; output: any; }
  /** Any constant literal value: https://graphql.github.io/graphql-spec/draft/#sec-Input-Values */
  EqValue: { input: any; output: any; }
  /** Any constant literal value: https://graphql.github.io/graphql-spec/draft/#sec-Input-Values */
  WhereKeyValue: { input: any; output: any; }
  /** Any constant literal value: https://graphql.github.io/graphql-spec/draft/#sec-Input-Values */
  WhereValue: { input: any; output: any; }
  /**
   * Placeholder type for various directives such as `@orderBy`.
   * Will be replaced by a generated type during schema manipulation.
   */
  _: { input: any; output: any; }
};

/** Options for the `function` argument of `@aggregate`. */
export enum AggregateFunction {
  /** Return the average value. */
  Avg = 'AVG',
  /** Return the maximum. */
  Max = 'MAX',
  /** Return the minimum. */
  Min = 'MIN',
  /** Return the sum. */
  Sum = 'SUM'
}

/** Options for the `type` argument of `@belongsToMany`. */
export enum BelongsToManyType {
  /** Cursor-based pagination, compatible with the Relay specification. */
  Connection = 'CONNECTION',
  /** Offset-based pagination, similar to the Laravel default. */
  Paginator = 'PAGINATOR',
  /** Offset-based pagination like the Laravel "Simple Pagination", which does not count the total number of records. */
  Simple = 'SIMPLE'
}

export enum CanAction {
  /** Throw generic "not authorized" exception to conceal the real error. */
  ExceptionNotAuthorized = 'EXCEPTION_NOT_AUTHORIZED',
  /** Pass exception to the client. */
  ExceptionPass = 'EXCEPTION_PASS',
  /** Return the value specified in `value` argument to conceal the real error. */
  ReturnValue = 'RETURN_VALUE'
}

/**
 * Options for the `idSource` argument of `@clearCache`.
 *
 * Exactly one of the fields must be given.
 */
export type ClearCacheIdSource = {
  /** Path of an argument the client passes to the field `@clearCache` is applied to. */
  argument?: InputMaybe<Scalars['String']['input']>;
  /** Path of a field in the result returned from the field `@clearCache` is applied to. */
  field?: InputMaybe<Scalars['String']['input']>;
};

/** Options for the `decode` argument of `@globalId`. */
export enum GlobalIdDecode {
  /** Return an array of `[$type, $id]`. */
  Array = 'ARRAY',
  /** Return just `$id`. */
  Id = 'ID',
  /** Return just `$type`. */
  Type = 'TYPE'
}

/** Options for the `type` argument of `@hasManyThrough`. */
export enum HasManyThroughType {
  /** Cursor-based pagination, compatible with the Relay specification. */
  Connection = 'CONNECTION',
  /** Offset-based pagination, similar to the Laravel default. */
  Paginator = 'PAGINATOR',
  /** Offset-based pagination like the Laravel "Simple Pagination", which does not count the total number of records. */
  Simple = 'SIMPLE'
}

/** Options for the `type` argument of `@hasMany`. */
export enum HasManyType {
  /** Cursor-based pagination, compatible with the Relay specification. */
  Connection = 'CONNECTION',
  /** Offset-based pagination, similar to the Laravel default. */
  Paginator = 'PAGINATOR',
  /** Offset-based pagination like the Laravel "Simple Pagination", which does not count the total number of records. */
  Simple = 'SIMPLE'
}

/** Options for the `type` argument of `@morphMany`. */
export enum MorphManyType {
  /** Cursor-based pagination, compatible with the Relay specification. */
  Connection = 'CONNECTION',
  /** Offset-based pagination, similar to the Laravel default. */
  Paginator = 'PAGINATOR',
  /** Offset-based pagination like the Laravel "Simple Pagination", which does not count the total number of records. */
  Simple = 'SIMPLE'
}

/** Options for the `type` argument of `@morphToMany`. */
export enum MorphToManyType {
  /** Cursor-based pagination, compatible with the Relay specification. */
  Connection = 'CONNECTION',
  /** Offset-based pagination, similar to the Laravel default. */
  Paginator = 'PAGINATOR',
  /** Offset-based pagination like the Laravel "Simple Pagination", which does not count the total number of records. */
  Simple = 'SIMPLE'
}

export type Mutation = {
  __typename?: 'Mutation';
  uploadVideo?: Maybe<Video>;
};


export type MutationUploadVideoArgs = {
  title: Scalars['String']['input'];
  user_id: Scalars['ID']['input'];
};

/** Allows ordering a list of records. */
export type OrderByClause = {
  /** The column that is used for ordering. */
  column: Scalars['String']['input'];
  /** The direction that is used for ordering. */
  order: SortOrder;
};

/** Options for the `direction` argument of `@orderBy`. */
export enum OrderByDirection {
  /** Sort in ascending order. */
  Asc = 'ASC',
  /** Sort in descending order. */
  Desc = 'DESC'
}

/** Options for the `relations` argument of `@orderBy`. */
export type OrderByRelation = {
  /**
   * Restrict the allowed column names to a well-defined list.
   * This improves introspection capabilities and security.
   * Mutually exclusive with `columnsEnum`.
   */
  columns?: InputMaybe<Array<Scalars['String']['input']>>;
  /**
   * Use an existing enumeration type to restrict the allowed columns to a predefined list.
   * This allows you to re-use the same enum for multiple fields.
   * Mutually exclusive with `columns`.
   */
  columnsEnum?: InputMaybe<Scalars['String']['input']>;
  /** Name of the relation. */
  relation: Scalars['String']['input'];
};

/** Aggregate functions when ordering by a relation without specifying a column. */
export enum OrderByRelationAggregateFunction {
  /** Amount of items. */
  Count = 'COUNT'
}

/** Aggregate functions when ordering by a relation that may specify a column. */
export enum OrderByRelationWithColumnAggregateFunction {
  /** Average. */
  Avg = 'AVG',
  /** Amount of items. */
  Count = 'COUNT',
  /** Maximum. */
  Max = 'MAX',
  /** Minimum. */
  Min = 'MIN',
  /** Sum. */
  Sum = 'SUM'
}

/** Options for the `type` argument of `@paginate`. */
export enum PaginateType {
  /** Cursor-based pagination, compatible with the Relay specification. */
  Connection = 'CONNECTION',
  /** Offset-based pagination, similar to the Laravel default. */
  Paginator = 'PAGINATOR',
  /** Offset-based pagination like the Laravel "Simple Pagination", which does not count the total number of records. */
  Simple = 'SIMPLE'
}

/** Information about pagination using a fully featured paginator. */
export type PaginatorInfo = {
  __typename?: 'PaginatorInfo';
  /** Number of items in the current page. */
  count: Scalars['Int']['output'];
  /** Index of the current page. */
  currentPage: Scalars['Int']['output'];
  /** Index of the first item in the current page. */
  firstItem?: Maybe<Scalars['Int']['output']>;
  /** Are there more pages after this one? */
  hasMorePages: Scalars['Boolean']['output'];
  /** Index of the last item in the current page. */
  lastItem?: Maybe<Scalars['Int']['output']>;
  /** Index of the last available page. */
  lastPage: Scalars['Int']['output'];
  /** Number of items per page. */
  perPage: Scalars['Int']['output'];
  /** Number of total available items. */
  total: Scalars['Int']['output'];
};

/** Indicates what fields are available at the top level of a query operation. */
export type Query = {
  __typename?: 'Query';
  /** Find a single user by an identifying attribute. */
  user?: Maybe<User>;
  /** List multiple users. */
  users: Array<User>;
  /** List multiple videos. */
  videos: Array<Video>;
};


/** Indicates what fields are available at the top level of a query operation. */
export type QueryUserArgs = {
  email?: InputMaybe<Scalars['String']['input']>;
  id?: InputMaybe<Scalars['ID']['input']>;
};


/** Indicates what fields are available at the top level of a query operation. */
export type QueryUsersArgs = {
  name?: InputMaybe<Scalars['String']['input']>;
};


/** Indicates what fields are available at the top level of a query operation. */
export type QueryVideosArgs = {
  title?: InputMaybe<Scalars['String']['input']>;
};

/** Input for the `messages` argument of `@rulesForArray`. */
export type RulesForArrayMessage = {
  /** Message to display if the rule fails, e.g. `"Must be a valid email"`. */
  message: Scalars['String']['input'];
  /** Name of the rule, e.g. `"email"`. */
  rule: Scalars['String']['input'];
};

/** Input for the `messages` argument of `@rules`. */
export type RulesMessage = {
  /** Message to display if the rule fails, e.g. `"Must be a valid email"`. */
  message: Scalars['String']['input'];
  /** Name of the rule, e.g. `"email"`. */
  rule: Scalars['String']['input'];
};

/** Directions for ordering a list of records. */
export enum SortOrder {
  /** Sort records in ascending order. */
  Asc = 'ASC',
  /** Sort records in descending order. */
  Desc = 'DESC'
}

/** Specify if you want to include or exclude trashed results from a query. */
export enum Trashed {
  /** Only return trashed results. */
  Only = 'ONLY',
  /** Return both trashed and non-trashed results. */
  With = 'WITH',
  /** Only return non-trashed results. */
  Without = 'WITHOUT'
}

/** Account of a person who utilizes this application. */
export type User = {
  __typename?: 'User';
  /** When the account was created. */
  created_at: Scalars['DateTime']['output'];
  /** Unique email address. */
  email: Scalars['String']['output'];
  /** When the email was verified. */
  email_verified_at?: Maybe<Scalars['DateTime']['output']>;
  /** Unique primary key. */
  id: Scalars['ID']['output'];
  /** Non-unique name. */
  name: Scalars['String']['output'];
  /** When the account was last updated. */
  updated_at: Scalars['DateTime']['output'];
  /** Videos uploaded by the user. */
  videos: Array<Video>;
};

/** A paginated list of User items. */
export type UserPaginator = {
  __typename?: 'UserPaginator';
  /** A list of User items. */
  data: Array<User>;
  /** Pagination information about the list of items. */
  paginatorInfo: PaginatorInfo;
};

export type Video = {
  __typename?: 'Video';
  /** Unique primary key. */
  id: Scalars['ID']['output'];
  /** Title of the video. */
  title: Scalars['String']['output'];
  /** When the video was uploaded. */
  uploaded_at: Scalars['DateTime']['output'];
  user: User;
};

/** A paginated list of Video items. */
export type VideoPaginator = {
  __typename?: 'VideoPaginator';
  /** A list of Video items. */
  data: Array<Video>;
  /** Pagination information about the list of items. */
  paginatorInfo: PaginatorInfo;
};

export type GetVideosQueryVariables = Exact<{
  title?: InputMaybe<Scalars['String']['input']>;
}>;


export type GetVideosQuery = { __typename?: 'Query', videos: Array<{ __typename?: 'Video', title: string, uploaded_at: any, user: { __typename?: 'User', name: string, email: string } }> };


export const GetVideosDocument = {"kind":"Document","definitions":[{"kind":"OperationDefinition","operation":"query","name":{"kind":"Name","value":"getVideos"},"variableDefinitions":[{"kind":"VariableDefinition","variable":{"kind":"Variable","name":{"kind":"Name","value":"title"}},"type":{"kind":"NamedType","name":{"kind":"Name","value":"String"}}}],"selectionSet":{"kind":"SelectionSet","selections":[{"kind":"Field","name":{"kind":"Name","value":"videos"},"arguments":[{"kind":"Argument","name":{"kind":"Name","value":"title"},"value":{"kind":"Variable","name":{"kind":"Name","value":"title"}}}],"selectionSet":{"kind":"SelectionSet","selections":[{"kind":"Field","name":{"kind":"Name","value":"title"}},{"kind":"Field","name":{"kind":"Name","value":"uploaded_at"}},{"kind":"Field","name":{"kind":"Name","value":"user"},"selectionSet":{"kind":"SelectionSet","selections":[{"kind":"Field","name":{"kind":"Name","value":"name"}},{"kind":"Field","name":{"kind":"Name","value":"email"}}]}}]}}]}}]} as unknown as DocumentNode<GetVideosQuery, GetVideosQueryVariables>;