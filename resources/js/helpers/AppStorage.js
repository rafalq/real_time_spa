class AppStorage {
    storeUserName(user_name) {
        sessionStorage.setItem("user_name", user_name);
    }

    storeToken(token) {
        sessionStorage.setItem("token", token);
    }

    store(user_name, token) {
        this.storeUserName(user_name);
        this.storeToken(token);
    }

    clear() {
        sessionStorage.removeItem("user_name");
        sessionStorage.removeItem("token");
    }

    getUserName() {
        return sessionStorage.getItem("user_name");
    }

    getToken() {
        return sessionStorage.getItem("token");
    }
}

export default AppStorage = new AppStorage();
