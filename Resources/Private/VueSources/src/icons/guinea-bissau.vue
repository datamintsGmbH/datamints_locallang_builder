<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#CB2322" d="M16,6H2C0.895,6,0,6.895,0,8v32c0,1.105,0.895,2,2,2h14V6z"></path> <path fill="#F8CC15" d="M48,24H16V6h30c1.105,0,2,0.895,2,2V24z"></path> <path fill="#078754" d="M48,40c0,1.105-0.895,2-2,2H16V24h32V40z"></path> <path fill="#000105" d="M12.184,22.543H9.238L8,19.859l-1.238,2.684H3.816l2.152,2.227L5.172,28L8,26.395L10.828,28l-0.797-3.23 L12.184,22.543z"></path></g></svg></template>

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