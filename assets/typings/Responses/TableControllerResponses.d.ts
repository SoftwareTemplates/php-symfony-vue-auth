import { Table } from "../Table";

/**
 * The response model of the /api/table/getAllTables endpoint
 */
export interface GetAllTablesResponse {
    /**
     * All tables that the user has access to
     */
    tables: Table[];
}

/**
 * The response model of the /api/table/createTable endpoint
 */
export interface CreateTableResponse {
    /**
     * The message returned by the server
     */
    message: string;
    /**
     * The table that has been created yet. Is undefined, if the creation failed
     */
    table?: Table;
}

/**
 * The response model of the /api/table/deleteTable
 */
export interface DeleteTableResponse {
    /**
     * The message returned by the server
     */
    message: string;
}

/**
 * The response model of the /api/table/getTable endpoint
 */
export interface GetTableResponse {
    /**
     * The message returned by the server
     */
    message?: string;
    /**
     * The table that has been fetched.
     */
    table?: Table;
}

/**
 * The response model of the /api/table/createElement endpoint
 */
export interface CreateElementResponse {
    /**
     * The message returned by the server
     */
    message: string;
    /**
     * The table within the new table element.
     */
    table?: Table;
}

/**
 * The response model of the /api/table/removeElement endpoint
 */
export interface RemoveElementResponse {
    /**
     * The message returned by the server
     */
    message: string;
    /**
     * The table without the element that has been removed
     */
    table?: Table;
}

/**
 * The response model of the /api/table/updateElement endpoint
 */
export interface UpdateElementResponse {
    /**
     * The message returned by the server
     */
    message: string;
    /**
     * The table within the changes from the updated element.
     */
    table?: Table;
}