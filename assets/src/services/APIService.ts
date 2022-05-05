import RestService from "./RestService";
import {LoginResponse} from "../../typings/Responses/LoginResponse";
import {User} from "../../typings/User";
import {CreateUserResponse, DeleteUserRespose, GetAllUsersResponse, UpdateUserResponse} from "../../typings/Responses/UserControllerResponses";
import { PermissionLevels } from "../permissions";

export default class APIService extends RestService {

    /**
     * Trys to log in the user.
     *
     * @param username The username of the user
     * @param password The password of the user
     * @return LoginResponse The login response of the server
     * @throws Error The possible error from the RestService
     */
    public async login(username: string, password: string): Promise<LoginResponse> {
        return await this.post<LoginResponse>('/api/login', JSON.stringify({
            username,
            password,
        }));
    }

    /**
     * Checks if the user is authorized and updates the state out of this.
     *
     * @throws Error If the user is not authorized
     */
    public async checkLogin(): Promise<User>
    {
        return await this.get<User>('/api/check_login');
    }

    /**
     * Fetches all users from the database.
     */
    public async getAllUsers(): Promise<GetAllUsersResponse> {
        return await this.get<GetAllUsersResponse>('/api/user/allUsers');
    }

    /**
     * Creates a new user in the system.
     *
     * @param username The username of the user
     * @param password The password of the user
     * @param permissionGroups All permission group IDs of the user
     * @param roles All roles the user should have
     */
    public async createUser(username: string, password: string, permissionGroups: number[], roles: PermissionLevels[]): Promise<CreateUserResponse> {
        return await this.post<CreateUserResponse>('/api/user/createUser', JSON.stringify({
            username,
            password,
            permissionGroups,
            roles
        }));
    }

    /**
     * Deletes an user from the system.
     * 
     * @param userID The ID of the user that should be deleted
     * @returns The response of the request
     */
    public async deleteUser(userID: number): Promise<DeleteUserRespose> {
        return await this.post<DeleteUserRespose>('/api/user/deleteUser', JSON.stringify({userID}));
    }

    /**
     * Updates an user.
     * 
     * @param id The ID of the user that should be updated.
     * @param username The new username.
     * @param permissionGroups All permission group IDs the user should have
     * @param roles All the roles the user should have
     * @returns The response of the request
     */
    public async updateUser(
        id: number,
        username: string,
        permissionGroups: number[],
        roles: PermissionLevels[]
    ): Promise<UpdateUserResponse> {
        return await this.post<UpdateUserResponse>('/api/user/updateUser', JSON.stringify({
            id: id,
            username: username,
            permissionGroups: permissionGroups,
            roles: roles
        }));
    }
}