class Token {
    isValid(token) {
        const payload = this.getPayload(token);
        if (payload) {
            return payload.iss === "http://127.0.0.1:8000/api/auth/login" ||
                payload.iss === "http://127.0.0.1:8000/api/auth/register"
                ? true
                : false;
        }

        return false;
    }

    getPayload(token) {
        const payload = token.split(".")[1];
        return this.decodePayload(payload);
    }

    decodePayload(payload) {
        if (this.isBase64(payload)) {
            return JSON.parse(atob(payload));
        }

        return false;
    }

    isBase64(string) {
        try {
            return btoa(atob(string)).replace(/=/g, "") === string;
        } catch (error) {
            return false;
        }
    }
}

export default Token = new Token();
