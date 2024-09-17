<template>
    <div class="grafana-dashboard">
        <iframe
            :src="grafanaUrl"
            width="100%"
            height="100%"
            frameborder="0"
        >
        </iframe>

        <iframe
            :src="monthlyStatistics"
            width="100%"
            height="100%"
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
            grafanaUrl: 'http://127.0.0.1:3000/public-dashboards/517ad51c497f4ac4ab394e198a59a745?orgId=1&kiosk&fullscreen',
            monthlyStatistics: 'http://localhost:3000/public-dashboards/4edb8f5db3674a3e864c3b321ed0cc96?orgId=1&kiosk&fullscreen'
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

