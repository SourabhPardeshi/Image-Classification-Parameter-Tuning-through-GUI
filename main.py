from flask import Flask     

app = Flask(__name__)



'''
def home():
    return render_template("home.html")
    
@app.route("/salvador")
def salvador():
    return "Hello, Salvador"
    
if __name__ == "__main__":
    app.run(debug=True)

'''
@app.route("/")
def index():
	return "<h1>Success of ladder</h1>"