/**
 * The default model of the table.
 */
export interface Table {
    /**
     * The ID of the table.
     */
    id: number;
    /**
     * The name of the table.
     */
    tableName: string;
    /**
     * All elements of the table.
     */
    elements?: any[];
}