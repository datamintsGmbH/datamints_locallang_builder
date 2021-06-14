<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" :width="width" :height="height"><g :fill="_secondaryfill"><path d="M16,4V2H11V1a1,1,0,0,0-1-1H6A1,1,0,0,0,5,1V2H0V4Z" :fill="_secondaryfill"></path><path d="M2,5v9a2,2,0,0,0,2,2h8a2,2,0,0,0,2-2V5Zm9.414,7.5L10,13.914l-2-2-2,2L4.586,12.5l2-2-2-2L6,7.086l2,2,2-2L11.414,8.5l-2,2Z" :fill="fill"></path></g></svg></template>

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