import {PermissionGroup} from "../PermissionGroup";

/**
 * The response model of the /api/permission-group/allGroups endpoint
 */
export interface GetAllPermissionGroupsResponse {
    /**
     * All permission groups in the system.
     */
    groups: PermissionGroup[];
}

/**
 * The response model of the /api/permission-group/createGroup endpoint
 */
export interface CreatePermissionGroupResponse {
    /**
     * The message returned by the server
     */
    message: string;
    /**
     * The permission group that has been created, if
     * the request waa successful.
     */
    group?: PermissionGroup;
}

/**
 * The response model of the /api/permission-group/deleteGroup endpoint
 */
export interface DeletePermissionGroupResponse {
    /**
     * The message returned by the server.
     */
    message: string;
}

/**
 * The response model of the /api/permission-group/removeUser endpoint
 */
export interface RemoveUserFromPermissionGroupResponse {
    /**
     * The message returned by the server
     */
    message: string;
}

/**
 * The response model of the /api/permission-group/addUser endpoint
 */
export interface AddUserToPermissionGroupResponse {
    /**
     * The message returned by the server.
     */
    message: string;
}

/**
 * The response model of the /api/permission-group/addTable endpoint
 */
export interface AddTableToPermissionGroupResponse {
    /**
     * The message returned by the server
     */
    message: string;
}

/**
 * The response model of the /api/permission-group/removeTable endpoint
 */
export interface RemoveTableFromPermissionGroupResponse {
    /**
     * The message returned by the server.
     */
    message: string;
}