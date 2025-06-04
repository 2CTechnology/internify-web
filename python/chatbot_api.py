from flask import Flask, request, jsonify
import pandas as pd
import re
import string
import os
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.metrics.pairwise import cosine_similarity
from flask_cors import CORS

app = Flask(__name__)
CORS(app)

# Daftar stopwords manual
stopwords = {
    "yang", "dan", "di", "ke", "dari", "untuk", "pada", "dengan", "adalah",
    "itu", "ini", "atau", "apa", "saja", "bagaimana", "kapan", "dimana", 
    "mengapa", "siapa", "jadi", "apakah", "karena", "dalam", "jika"
}

# Fungsi preprocessing
def preprocess(text):
    text = text.lower()
    text = re.sub(rf"[{string.punctuation}]", "", text)
    tokens = text.split()
    tokens = [t for t in tokens if t not in stopwords]
    return " ".join(tokens)

# Load dataset
BASE_DIR = os.path.dirname(os.path.abspath(__file__))
df = pd.read_csv(os.path.join(BASE_DIR, "dataset_chatbot_updated5.csv"))

# TF-IDF vectorization
vectorizer = TfidfVectorizer()
tfidf_matrix = vectorizer.fit_transform(df['processed'])

# Fungsi untuk menjawab pertanyaan
def jawab_pertanyaan(pertanyaan_user):
    user_processed = preprocess(pertanyaan_user)
    user_vec = vectorizer.transform([user_processed])
    sim_scores = cosine_similarity(user_vec, tfidf_matrix)
    
    skor_tertinggi = sim_scores.max()
    idx_tertinggi = sim_scores.argmax()

    if skor_tertinggi > 0.5:  # Batas minimum kemiripan
        return df.iloc[idx_tertinggi]['jawaban']
    else:
        return "Maaf, saya belum bisa memahami pertanyaan itu. Silahkan tanyakan kepada koordinator magang."

# Flask route for API
@app.route("/chatbot", methods=["POST"])
def chat():
    data = request.get_json()
    pertanyaan = data.get("pertanyaan", "")
    jawaban = jawab_pertanyaan(pertanyaan)
    return jsonify({"jawaban": jawaban})

if __name__ == "__main__":
    app.run(host="0.0.0.0", port=5000)