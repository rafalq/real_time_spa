class AppStorage {
    storeUserName(user_name) {
        localStorage.setItem("user_name", user_name);
    }

    storeToken(token) {
        localStorage.setItem("token", token);
    }

    store(user_name, token) {
        this.storeUserName(user_name);
        this.storeToken(token);
    }

    clear() {
        localStorage.removeItem("user_name");
        localStorage.removeItem("token");
    }

    getUserName() {
        return localStorage.getItem("user_name");
    }

    getToken() {
        return localStorage.getItem("token");
    }
}

export default AppStorage = new AppStorage();
