/**
 * All possible roles/permissions a user can have 
 * to authorize in the webapp.
 * 
 * @enum {string} Possible role of an user
 */
export enum PermissionLevels {
    ALL='ALL',
    ROLE_USER='ROLE_USER',
    ROLE_ADMIN='ROLE_ADMIN',
    ROLE_MANAGER='ROLE_MANAGER'
}