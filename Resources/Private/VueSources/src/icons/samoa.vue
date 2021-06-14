<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#040385" d="M20,22H0V8c0-1.105,0.895-2,2-2h18V22z"></path> <path fill="#FC0204" d="M46,6H20v16H0v18c0,1.105,0.895,2,2,2h44c1.105,0,2-0.895,2-2V24V8C48,6.895,47.105,6,46,6z"></path> <path fill="#FFFFFF" d="M17.66,10.189h-2.272l-0.955-2.072l-0.953,2.072h-2.273l1.66,1.711l-0.613,2.494l2.18-1.238l2.182,1.238 L16,11.9L17.66,10.189z"></path> <path fill="#FFFFFF" d="M8,11.537H6.316L5.607,10l-0.709,1.537H3.215l1.231,1.269l-0.455,1.85l1.617-0.918l1.617,0.918l-0.455-1.85 L8,11.537z"></path> <path fill="#FFFFFF" d="M16,17.027h-1.658l-0.697-1.514l-0.697,1.514h-1.658l1.211,1.246l-0.445,1.82l1.59-0.902l1.592,0.902 l-0.451-1.82L16,17.027z"></path> <path fill="#FFFFFF" d="M10,17.723H8.771l-0.516-1.121l-0.519,1.121H6.508l0.9,0.928L7.072,20l1.184-0.67L9.436,20l-0.332-1.35 L10,17.723z"></path></g></svg></template>

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