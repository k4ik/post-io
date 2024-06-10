<template>
    <main class="main">
        <div class="container">
            <div class="flex absolute top-7p left-19p gap-1 items-center">
                <img src="../assets/images/logo.png" alt="logo" class="w-12">
                <p class="font-jetbrains font-bold">POST.<br><span class="text-purple">IO</span></p>
            </div>
            <form id="form" class="form">
                <fieldset class="fieldset">
                    <User />
                    <input class="input" type="text" name="name" placeholder="Name" autocomplete="off">
                </fieldset>
                <fieldset class="fieldset">
                    <Mail />
                    <input class="input" type="email" name="email" placeholder="example@email.com" autocomplete="off">
                </fieldset>
                <fieldset class="fieldset">
                    <Lock />
                    <input class="input" type="password" name="password" placeholder="******" autocomplete="off">
                </fieldset>
                <fieldset class="fieldset">
                    <Lock />
                    <input class="input" type="password" name="password" placeholder="******" autocomplete="off">
                </fieldset>
                <button @click.prevent="fetchData" class="bg-purple max-w-80 w-full rounded-3 font-bold py-1 border-2 border-text-color hover:bg-hpurple transition-colors">CRIAR MINHA CONTA</button>
                <p class="text-sm font-bold">Já possui uma conta? <router-link to="/" class="underline">Faça login</router-link> </p>
            </form>
        </div>
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

<style scoped>
    .main {
        @apply bg-purple h-screen text-text-color font-poppins flex justify-center items-center;
    }

    .container {
        @apply bg-form max-w-lg flex flex-col h-156 justify-center rounded-10 shadow-2xl w-full relative;
    }

    .form {
       @apply flex flex-col gap-6 items-center;
    }
    
    .input {
        @apply w-full bg-transparent outline-none border-b border-text-color;
    }

    .fieldset {
        @apply flex gap-4 max-w-80 w-full;
    }
</style>