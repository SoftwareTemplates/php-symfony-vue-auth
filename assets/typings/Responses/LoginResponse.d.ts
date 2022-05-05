import {PermissionLevels} from "@/permissions";

/**
 * The response model of the /api/login endpoint
 */
export interface LoginResponse {
    /**
     * The username of the user
     */
    userIdentifier: string;
    /**
     * The token that the user can use for authorization
     */
    token: string;
    /**
     * All roles of the logged in user.
     */
    roles: PermissionLevels[];
}