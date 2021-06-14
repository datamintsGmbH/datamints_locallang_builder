<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g stroke-miterlimit="10" :fill="_secondaryfill" :stroke="_secondaryfill"><path d="M19.224,22A9,9,0,0,1,35,18.342" fill="none" stroke-linecap="square" stroke-width="2" stroke-linejoin="miter" :stroke="_secondaryfill"></path><polygon points="37.899 14.101 30.828 21.172 39 22 37.899 14.101" :fill="_secondaryfill"></polygon><path d="M36.776,26A9,9,0,0,1,21,29.658" fill="none" stroke-linecap="square" stroke-width="2" stroke-linejoin="miter" :stroke="_secondaryfill"></path><polygon points="18.101 33.899 25.172 26.828 17 26 18.101 33.899" :fill="_secondaryfill"></polygon><path d="M29,6A16.994,16.994,0,0,0,12.278,20.014c-.093,0-.184-.014-.278-.014a10,10,0,0,0,0,20H29A17,17,0,0,0,29,6Z" fill="none" stroke-linecap="square" stroke-width="2" stroke-linejoin="miter" :stroke="fill"></path></g></svg></template>

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