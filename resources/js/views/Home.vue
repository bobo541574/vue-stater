<template>
    <main-layout>
        <div class="mx-auto text-3xl font-semibold">
            Home
        </div>
    </main-layout>
</template>

<script>
import { onMounted, inject } from 'vue';
export default {
    name: "Home",

    setup () {
        const eventBus = inject('eventBus');
        const trans = inject('trans');
        
        onMounted(() => {
            eventBus.on('localeChange', (data) => {
                console.log(trans(data));
            });
        });

        return {}
    }
}
</script>