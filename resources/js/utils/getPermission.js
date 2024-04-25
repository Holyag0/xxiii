import { el } from "date-fns/locale";

export default {
    methods: {
        getPermission(permission) {
            let allPermissions = this.$page.props.auth.user.permissions

            return allPermissions.find(element => element.name == permission);
        },
    },
};