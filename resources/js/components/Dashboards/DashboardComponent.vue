<template>
    <div class="grafana-dashboard">
        <iframe
            :src="grafanaUrl"
            width="450"
            height="200"
            frameborder="0"
        >
        </iframe>
    </div>
</template>

<script>

export default {
    name: 'AppDashboardComponent',
    data() {
        return {
            grafanaUrl: 'http://127.0.0.1:3000/d-solo/cdy4lzbvshfcwe/ventas-por-dia?orgId=1&from=1726518376487&to=1726539976487&panelId=1'
        }
    },
    mounted() {

    },
    created() {

    },
    methods: {

    }
}
</script>

