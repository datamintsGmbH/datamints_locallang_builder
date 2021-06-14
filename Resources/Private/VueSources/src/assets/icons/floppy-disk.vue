<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" :width="width" :height="height"><g :fill="fill"><path fill="none" stroke-linecap="square" stroke-miterlimit="10" stroke-width="1" d="M12.6 3.78v3.36h-7.98v-3.36" :stroke="_secondaryfill"></path><path fill="none" stroke-linecap="square" stroke-miterlimit="10" stroke-width="1" d="M10.08 3.78v1.26" :stroke="_secondaryfill"></path><path fill="none" stroke-linecap="square" stroke-miterlimit="10" stroke-width="1" d="M4.62 16.38v-4.62h10.92v4.62" :stroke="_secondaryfill"></path><path d="M16.8 18.48h-13.44a1.68 1.68 0 0 1-1.68-1.68v-13.44a1.68 1.68 0 0 1 1.68-1.68h11.34l3.78 3.78v11.34a1.68 1.68 0 0 1-1.68 1.68z" fill="none" stroke-linecap="square" stroke-miterlimit="10" stroke-width="1" :stroke="fill"></path></g></svg></template>

<script>
export default {
	props: {
		width: {
			type: [Number, String],
			default: "100%"
		},
		height: {
			type: [Number, String],
			default: "100%"
		},
		fill: {
			type: String,
			default: "currentColor"
		},
		secondaryfill: {
			type: String
		}
	},
	computed: {
		_secondaryfill: function () {
			return this.secondaryfill || this.fill
		}
	}
}
</script>