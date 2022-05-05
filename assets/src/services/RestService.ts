import {ErrorResponse} from "../../typings/Responses/ErrorResponse";


export default class RestService {

    /**
     * The general shaped request function for doing a
     * REST http request.
     *
     * @param method The request method
     * @param path The path to the endpoint
     * @param body The request body if its given
     * @param contentType The content type of the request
     * @return Promise<T> The generic promise response
     * @throws Error If the status code is not 200
     */
    private static async fetchEndpoint<T>(
        method: string,
        path: string,
        body?: any,
        contentType: string | undefined = 'application/json'
    ): Promise<T> {
        const fetchResult = await window.fetch(path, {
            body: body,
            method: method,
            headers: {
                'Content-Type': contentType
            }
        });
        if (fetchResult.status !== 200) {
            // Parse to generic error response
            const response = (await fetchResult.json()) as ErrorResponse;
            throw new Error(response.message);
        }
        return (await fetchResult.json()) as T;
    }

    /**
     * The general GET request.
     *
     * @param path The path to the endpoint
     * @return Promise<T> The response as generic promise
     */
    protected async get<T>(path: string): Promise<T> {
        return await RestService.fetchEndpoint<T>("GET", path);
    }

    /**
     * The general POST request.
     *
     * @param path The path to the resp endpoint
     * @param body The http body of the request
     * @return Promise<T> The response as generic promise
     */
    protected async post<T>(path: string, body: any): Promise<T> {
        return await RestService.fetchEndpoint<T>("POST", path, body);
    }
}