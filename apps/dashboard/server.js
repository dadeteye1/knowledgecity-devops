const express = require("express");
const fetch = require("node-fetch");
const app = express();
const PORT = 3000;

app.get("/", async (req, res) => {
  res.send("<h1>KnowledgeCity Dashboard</h1><p>All systems healthy ✅</p>");
});

app.listen(PORT, () => console.log(`Dashboard running on port ${PORT}`));
