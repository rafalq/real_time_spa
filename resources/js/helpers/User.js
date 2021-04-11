import Token from "./Token";
import AppStorage from "./AppStorage";

class User {
    login(data) {
        axios
            .post("/api/auth/login", data)
            .then(response => this.responseAfterLogin(response))
            .catch(err => console.error(err));
    }

    responseAfterLogin(response) {
        const access_token = response.data.access_token;
        const user_name = response.data.user_name;

        if (Token.isValid(access_token)) {
            AppStorage.store(user_name, access_token);
        }
    }

    hasToken() {
        const storedToken = AppStorage.getToken();

        if (storedToken) {
            return Token.isValid(storedToken) ? true : false;
        }

        return false;
    }

    loggedIn() {
        return this.hasToken();
    }

    logout() {
        AppStorage.clear();
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
}

export default User = new User();
