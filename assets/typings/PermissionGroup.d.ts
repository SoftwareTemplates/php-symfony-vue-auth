/**
 * The user type that is included in the relation 
 * in the default permission group type.
 */
export interface PermissionGroupUserType {
    /**
     * The ID of the user
     */
    id: number;
    /**
     * The name of the user
     */
    name: string;
}

/**
 * The table type that is included in the relation 
 * in the default permission group type.
 */
export interface PermissionGroupTableType {
    /**
     * The ID of the table
     */
    id: number;
    /**
     * The name of the table.
     */
    name: string;
}

/**
 * The base model of the permission group.
 */
export interface PermissionGroup {
    /**
     * The ID of the permission group
     */
    id: number;
    /**
     * The name of the permission group
     */
    name: string;
    /**
     * The color of the permissionGroup
     */
    groupColor: string;
    /**
     * All tables that are included in the permissio group
     */
    tables: PermissionGroupTableType[];
    /**
     * All users that are included in the permission group
     */
    users: PermissionGroupUserType[];
}