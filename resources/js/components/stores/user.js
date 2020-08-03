import {writable} from 'svelte/store';

export let userLogin = writable(false);
export let infoUser = writable({
   notaAgregada:false
});
