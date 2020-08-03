<script>
    import Nav from "./Nav.svelte";
    import { Router, Route } from "svelte-routing";
    import Index from './routes/Index.svelte';
    import Login from './routes/Login.svelte';
    import Registro from './routes/Registro.svelte';
    import Notas from './routes/Notas.svelte';
    import Redactar from './routes/Redactar.svelte';
    import Error404 from './routes/Error404.svelte';

    export let url = "";
</script>
<style>
    .grid{
        display: grid;
        width: 100%;
        height: 100vh;
        grid-template-columns: repeat(5, 1fr);
    }
    .nav{
        grid-column: 1/2;
    }
    .contenido{
        position: relative;
        padding: 2rem;
        font-family: 'Roboto', sans-serif;
        grid-column: 2/-1;
        background: #f1f1f159;
    }
</style>
<Router url="{url}">
    <div class="grid">
        <div class="nav">
            <Nav/>
        </div>
        <div class="contenido">
            <main>
                <Route path="/" component="{Index}" />
                <Route path="notas" component="{Notas}" />
                <Route path="redactar" component="{Redactar}" />
                <Route path="iniciar" component="{Login}" />
                <Route path="registrar" component="{Registro}" />
                <Route path="*" component="{Error404}" />
            </main>
        </div>
    </div>
</Router>
