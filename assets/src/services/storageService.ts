import {User} from "../../typings/User";


interface StorageData {
    /**
     * The current logged in user
     */
    activeUser: User|null;
}

/**
 * Used for reading and writing data from the local storage
 */
export class StorageService {

    
    private readonly data: StorageData;

    constructor() {
        if (localStorage.getItem('storageData')) {
            this.data = JSON.parse(localStorage.getItem('storageData') as string) as StorageData;
        } else {
            this.data = {
                activeUser: null
            };
        }
    }

    /**
     * Writes all current data into the local storage of the brwoser.
     *
     * @private Only used internally
     * @memberof StorageService
     */
    private writeData() {
        localStorage.setItem('storageData', JSON.stringify(this.data));
    }

    /**
     * Gets the currently logged in user.
     *
     * @return {*}  {(User|null)} The active user
     * @memberof StorageService
     */
    public getActiveUser(): User|null {
        return this.data.activeUser;
    }

    /**
     * Sets the new active user and writes it into the local storage
     *
     * @param {(User|null)} user The new user that is currently logged in 
     * @memberof StorageService
     */
    public setActiveUser(user: User|null) {
        this.data.activeUser = user;
        this.writeData();
    }


}