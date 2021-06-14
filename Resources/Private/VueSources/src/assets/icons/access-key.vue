<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 12 12" :width="width" :height="height"><g :fill="_secondaryfill"><path d="M11.707.293a1,1,0,0,0-1.414,0L5.886,4.7A4.5,4.5,0,0,1,7.3,6.114L8.707,4.707,10,6l2-2L10.707,2.707l1-1A1,1,0,0,0,11.707.293Z" :fill="_secondaryfill"></path> <circle cx="3.5" cy="8.5" r="3.5" :fill="fill"></circle></g></svg></template>

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