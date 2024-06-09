<template>
    <main>
        <form id="form">
            <fieldset>
                <User />
                <label for="name">Nome:</label>
                <input type="text" name="name">
            </fieldset>
            <fieldset>
                <Mail />
                <label for="email">Email:</label>
                <input type="email" name="email">
            </fieldset>
            <fieldset>
                <Lock />
                <label for="password">Senha:</label>
                <input type="password" name="password">
            </fieldset>
            <fieldset>
                <Lock />
                <label for="confirmPassword">Repita sua senha:</label>
                <input type="password" name="confirmPassword">
            </fieldset>
            <button @click.prevent="fetchData">Cadastrar-se</button>
        </form>
    </main>
</template>

<script>
import { Mail, Lock, User } from "lucide-vue-next";

export default {
    methods: {
        fetchData() {
            let form = document.getElementById("form");
            let formData = new FormData(form);

            fetch("", {
                method: "POST",
                body: formData
            })
            .then(response => response.json())
            .then(data => {

            })
            .catch(error => {
                console.log(error)
            })
        }
    },
    components: {
        Mail, Lock, User
    },
}
</script>
