export default {
    methods: {
        getRole(roles) {
            let allRoles = this.$page.props.auth.user.roles

            return allRoles.find(element => element.name == roles);
        }
    },
};