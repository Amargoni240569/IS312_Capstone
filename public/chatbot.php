<?php
echo '
<!-- MESSAGE ICON -->
<div id="chatIcon" onclick="toggleChat()">💬</div>

<!-- POPUP CHAT BOX -->
<div id="chatPopup">
  <div id="chatHeader">
    BakersBakery Assistant
    <span onclick="toggleChat()" style="float:right; cursor:pointer;">✖</span>
  </div>

  <div id="chatMessages"></div>

  <div id="chatInputArea">
    <input type="text" id="userMessage" placeholder="Type your message...">
    <button onclick="sendMessage()">Send</button>
  </div>
</div>

<style>
#chatIcon{
  position: fixed;
  bottom: 20px;
  right: 20px;
  width: 60px;
  height: 60px;
  background: #d2691e;
  color: white;
  border-radius: 50%;
  display: flex;
  justify-content: center;
  align-items: center;
  font-size: 30px;
  cursor: pointer;
  box-shadow: 0 0 10px gray;
  z-index: 9999;
}

#chatPopup{
  display: none;
  position: fixed;
  bottom: 90px;
  right: 20px;
  width: 320px;
  background: white;
  border-radius: 12px;
  box-shadow: 0 0 15px gray;
  overflow: hidden;
  font-family: Arial, sans-serif;
  z-index: 9999;
}

#chatHeader{
  background: #d2691e;
  color: white;
  padding: 12px;
  font-weight: bold;
}

#chatMessages{
  height: 250px;
  padding: 10px;
  overflow-y: auto;
  background: #f9f9f9;
  color: black;
}

#chatInputArea{
  display: flex;
  border-top: 1px solid #ccc;
}

#userMessage{
  flex: 1;
  border: none;
  padding: 10px;
  outline: none;
}

#chatInputArea button{
  border: none;
  background: #d2691e;
  color: white;
  padding: 10px 15px;
  cursor: pointer;
}
</style>

<script>
function toggleChat() {
  var popup = document.getElementById("chatPopup");
  popup.style.display = popup.style.display === "block" ? "none" : "block";
}

function sendMessage() {
  var input = document.getElementById("userMessage");
  var message = input.value.trim();
  var chatMessages = document.getElementById("chatMessages");

  if (message === "") {
    return;
  }

  chatMessages.innerHTML += "<p><b>You:</b> " + message + "</p>";

  var lowerMessage = message.toLowerCase();
  var reply = "Thank you for contacting BakersBakery. I can help you with reviews, cakes, products, location and contact information.";

  if (lowerMessage.includes("review")) {
    reply = "You can submit your review in the review section.";
  } else if (lowerMessage.includes("cake") || lowerMessage.includes("product")) {
    reply = "You can view our cakes and bakery products in the products section.";
  } else if (lowerMessage.includes("contact") || lowerMessage.includes("phone")) {
    reply = "You can contact BakersBakery using the contact details in the contact page.";
  } else if (lowerMessage.includes("location")) {
    reply = "Please check the location section for BakersBakery address.";
  }

  chatMessages.innerHTML += "<p><b>Assistant:</b> " + reply + "</p>";

  input.value = "";
  chatMessages.scrollTop = chatMessages.scrollHeight;
}
</script>
';
?>