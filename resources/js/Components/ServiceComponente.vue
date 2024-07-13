<script>
export default {
    name: "ServiceComponent",
    props: {
        planoAcademicos: Object,
    },
    methods: {
        getProps() {
            return {
                planoAcademicos: this.planoAcademicos
            }
        }
    }
}
</script>

