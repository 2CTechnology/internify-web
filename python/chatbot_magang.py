import streamlit as st
import pandas as pd
import re
import string
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.metrics.pairwise import cosine_similarity

# Set config Streamlit
st.set_page_config(page_title="Chatbot Magang", page_icon="💼")

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
@st.cache_data
def load_data():
    df = pd.read_csv("dataset_chatbot_updated5.csv")
    return df

df = load_data()

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

# UI Streamlit
st.title("🤖 Chatbot Magang")
st.write("Tanyakan apa saja seputar program magang!")

user_input = st.text_input("Tulis pertanyaan kamu di sini...")

if user_input:
    jawaban = jawab_pertanyaan(user_input)
    st.markdown(f"**Jawaban:** {jawaban}")
