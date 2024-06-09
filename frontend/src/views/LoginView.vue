<template>
    <main>
        <form id="form">
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
            <button @click.prevent="fetchData">Entrar</button>
        </form>
    </main>
</template>

<script>
import { Mail, Lock } from "lucide-vue-next";

export default {
    methods: {
        fetchData() {
            let formData = new FormData(document.getElementByid("form"));

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
        Mail, Lock
    },
}
</script>