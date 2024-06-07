<template>
    <main>
        <form id="form">
            <fieldset>
                <label for="name">Nome:</label>
                <input type="text" name="name">
            </fieldset>
            <fieldset>
                <label for="email">Email:</label>
                <input type="email" name="email">
            </fieldset>
            <fieldset>
                <label for="password">Senha:</label>
                <input type="password" name="password">
            </fieldset>
            <fieldset>
                <label for="confirmPassword">Repita sua senha:</label>
                <input type="password" name="confirmPassword">
            </fieldset>
            <button @click.prevent="fetchData">Cadastrar-se</button>
        </form>
    </main>
    <!--<Mail />-->
</template>

<script>
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
                // Lidar com a resposta
            })
            .catch(error => {
                console.log(error)
            })
        }
    }
}
</script>
