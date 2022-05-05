/**
 * The general error response of the backend
 */
export interface ErrorResponse {
    /**
     * The message that is returned by the server
     */
    message: string;
    /**
     * The status code of the response
     */
    code?: number;
}