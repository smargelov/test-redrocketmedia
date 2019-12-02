var smartgrid = require("smart-grid");

var settings = {
  filename: "grid",
  outputStyle: "sass",
  columns: 12,
  mobileFirst: false,
  container: {
    maxWidth: "1170px"
  }
};

smartgrid("./dev/static/styles/utils", settings);
