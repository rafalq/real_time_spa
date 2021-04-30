import Token from "./Token";
import AppStorage from "./AppStorage";

class User {
    responseAfterLogin(response) {
        const access_token = response.data.access_token;
        const user_name = response.data.user_name;

        if (Token.isValid(access_token)) {
            AppStorage.store(user_name, access_token);
            window.location = "/forum";
        }
    }

    hasToken() {
        const storedToken = AppStorage.getToken();

        if (storedToken) {
            return Token.isValid(storedToken) ? true : this.logout();
        }

        return false;
    }

    loggedIn() {
        return this.hasToken();
    }

    logout() {
        AppStorage.clear();
        window.location = "/login";
    }

    getName() {
        if (this.loggedIn) {
            return AppStorage.getUserName();
        }
    }

    getId() {
        if (this.loggedIn) {
            const payload = Token.getPayload(AppStorage.getToken());
            return payload.sub;
        }
    }

    own(id) {
        return this.getId() === id;
    }

    admin() {
        return this.getId() === 59;
    }
}

export default User = new User();
