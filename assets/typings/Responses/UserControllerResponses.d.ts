import {User} from "../User";

/**
 * The response model of the /api/user/allUsers endpoint
 */
export interface GetAllUsersResponse {
    /**
     * All users that are listed in the system.
     */
    users: User[];
}

/**
 * The response model of the /api/user/createUser endpoint
 */
export interface CreateUserResponse {
    /**
     * The message returned by the server
     */
    message: string;
    /**
     * The user that has been created.
     */
    user?: User;
}

/**
 * The response model of the /api/user/deleteUser endpoint.
 */
export interface DeleteUserRespose {
    /**
     * The message returned by the server
     */
    message: string;
    /**
     * Indicates whether the request was successful
     */
    success?: boolean;
}

/**
 * The response model of the /api/user/updateUser endpoint
 */
export interface UpdateUserResponse {
    /**
     * The message returned by the server
     */
    message: string;
    /**
     * The user that has been updated.
     */
    user?: User;
}