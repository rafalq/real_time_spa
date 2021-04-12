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
        return JSON.parse(atob(payload));
    }
}

export default Token = new Token();
