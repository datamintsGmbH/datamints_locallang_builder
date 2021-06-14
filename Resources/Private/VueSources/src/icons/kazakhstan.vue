<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#01B1C8" d="M48,40c0,1.105-0.895,2-2,2H2c-1.105,0-2-0.895-2-2V8c0-1.105,0.895-2,2-2h44c1.105,0,2,0.895,2,2V40z"></path> <circle fill="#F8CC15" cx="24" cy="22" r="6"></circle> <path fill="#F8CC15" d="M24,32c-6.065,0-11-4.935-11-11c0-0.553,0.447-1,1-1s1,0.447,1,1c0,4.963,4.037,9,9,9s9-4.037,9-9 c0-0.553,0.447-1,1-1s1,0.447,1,1C35,27.065,30.065,32,24,32z"></path></g></svg></template>

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