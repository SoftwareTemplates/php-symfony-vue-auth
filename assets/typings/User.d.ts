import {LoginResponse} from "./Responses/LoginResponse";
import {PermissionGroup} from "./PermissionGroup";

/**
 * The typing of the user, that is extracted from the login response.
 * Furthermore it adds some extra fields that are used for other user
 * interactions.
 */
export type User = Pick<LoginResponse, 'userIdentifier' | 'roles'>
    & {permissionGroups?: PermissionGroup[], id?: number};