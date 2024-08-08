<template>
    <div>
        <h3>Notifications</h3>
        <ul>
            <li v-for="notification in notifications" :key="notification.id">
                {{ notification.message }}
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    data() {
        return {
            notifications: []
        };
    },
    mounted() {
        this.listenForNotifications();
    },
    methods: {
        listenForNotifications() {
            window.Echo.channel('brts')
                .listen('BRTCreated', (event) => {
                    this.notifications.push({
                        id: event.brt.id,
                        message: `New BRT Created: ${event.brt.brt_code} reserved ${event.brt.reserved_amount} BLUME COIN`
                    });
                });
        }
    }
};
</script>
