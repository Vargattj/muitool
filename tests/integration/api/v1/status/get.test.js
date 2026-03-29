test("GET status", async () => {
  const response = await fetch("http://localhost:3000/api/v1/status");
  console.log("response,", response);
  expect(response.status).toBe(200);
});
